<?php
// Configurações do banco de dados
$host = '192.168.102.100';
$usuario = 'CONTAINER018';
$senha = '1F(966813)';
$banco = 'BD018';

// Conectando ao banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Conexão com MySQL falhou: " . $conn->connect_error);
}

// Diretório de configuração do ProFTPD
$ftp_conf_dir = "/etc/proftpd/";
$ftp_conf_file = $ftp_conf_dir . "proftpd_virtual.conf";

// Diretório base para FTP
$ftp_base_dir = "/var/ftp/";

// Criar diretório se não existir
if (!is_dir($ftp_base_dir)) {
    mkdir($ftp_base_dir, 0755, true);
}

// Limpar o arquivo de configuração antes de recriar
file_put_contents($ftp_conf_file, "");

// Buscar os domínios no banco de dados
$sql = "SELECT domain FROM domains";
$result = $conn->query($sql);

// Processar cada domínio
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dominio = $row['domain'];
        $ftp_user = str_replace('.', '_', $dominio); // Nome do usuário FTP baseado no domínio
        $ftp_home = $ftp_base_dir . $dominio;

        // Criar diretório para o domínio se não existir
        if (!is_dir($ftp_home)) {
            mkdir($ftp_home, 0755, true);
            echo "Criado diretório FTP para: $dominio\n";
        }

        // Definir permissões corretas
        chown($ftp_home, 'ftp');
        chgrp($ftp_home, 'ftp');

        // Adicionar usuário virtual ao ProFTPD
        $ftp_config = <<<CONF
<VirtualHost $dominio>
    ServerName "$dominio FTP"
    DefaultRoot $ftp_home
    RequireValidShell off
</VirtualHost>

CONF;

        file_put_contents($ftp_conf_file, $ftp_config, FILE_APPEND);
    }
} else {
    echo "Nenhum domínio encontrado no banco de dados.\n";
}

$conn->close();

// Reiniciar o serviço ProFTPD
exec("systemctl restart proftpd");

echo "Configuração do servidor FTP concluída com sucesso.\n";
?>
