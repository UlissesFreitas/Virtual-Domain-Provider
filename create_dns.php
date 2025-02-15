<?php
// Configuracoes do banco de dados
$host = '127.0.0.1';
$usuario = 'root';
$senha = 'example';
$banco = 'teste_dns';

// Conectando ao banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar os domínios
$sql = "SELECT domain FROM domains";
$result = $conn->query($sql);

// Arquivos de configuração
$named_conf = '/var/projeto-asa/dns/named.conf.projeto';
$zonas_conf = '/var/projeto-asa/dns/zonas.projeto';

// Limpar os arquivos antes de adicionar novas configurações
file_put_contents($named_conf, '');
file_put_contents($zonas_conf, '');

// IP padrão para os registros
$ip = '192.168.102.127'; # Ex de ip

// Processando cada domínio
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $dominio = $row['domain'];

        // Ignorar domínios específicos como o do admin, posso utilizar as tags para n precisar filtrar isso
        #if ($dominio === 'mailadmin.local' || $dominio === 'f.admin.local') {
        #    continue;
        #}

        // Adicionar configuração ao named.conf.projeto
        $named_conf_entry = <<<NAMED
zone "$dominio" IN {
       type master;
       file "/var/projeto-asa/dns/zonas.projeto";
       allow-query { any; };
};

NAMED;

        file_put_contents($named_conf, $named_conf_entry, FILE_APPEND);

        // Garantir que o domínio termine com um ponto
        if (substr($dominio, -1) !== '.') {
            $dominio .= '.';
        }

        // Criar o serial com a data atual
        $serial = date('Ymd') . '00';

        // Adicionar configuração ao zonas.projeto
        $zonas_entry = <<<ZONE
\$TTL 30
\$ORIGIN $dominio
@      IN      SOA     $dominio                root   (
               $serial
               2M
               1M
               5M
               30      )

       IN      A       $ip
       IN      NS      @
       IN      MX  5   mail

www                  IN      CNAME   @
mail                 IN      A       $ip
ftp                  IN      A       $ip

ZONE;

        file_put_contents($zonas_conf, $zonas_entry, FILE_APPEND);
    }
} else {
    echo "Nenhum domínio encontrado no banco de dados.";
}

// Alterar permissões dos arquivos, 
// Está comentado pois tenho certeza que vai dar erro de permissão, então modificar as permissões por fora se necessário.
#chgrp($named_conf, 'apache');
#chown($named_conf, 'apache');

$conn->close();

echo "Configurações de DNS geradas com sucesso.\n";
?>
