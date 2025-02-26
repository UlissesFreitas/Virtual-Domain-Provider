<?php
if ($argc < 2) {
    die("Uso: php criar_dominio.php <dominio>\n");
}

$dominio = $argv[1]; // Obtém o domínio passado como argumento
$documentRoot = "/var/www/$dominio/public_html";
$configFile = "/etc/apache2/sites-available/$dominio.conf";

// Verifica se o domínio já existe
if (file_exists($configFile)) {
    die("Erro: O domínio '$dominio' já existe!\n");
}

// Criar diretório do domínio
mkdir($documentRoot, 0755, true);
file_put_contents("$documentRoot/index.php", "<?php echo 'Site de $dominio funcionando!'; ?>");

// Criar arquivo de configuração do Virtual Host
$conf = <<<EOL
<VirtualHost *:80>
    ServerAdmin admin@$dominio
    ServerName $dominio
    ServerAlias www.$dominio
    DocumentRoot $documentRoot

    <Directory $documentRoot>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/$dominio-error.log
    CustomLog \${APACHE_LOG_DIR}/$dominio-access.log combined
</VirtualHost>
EOL;

file_put_contents($configFile, $conf);

// Ativar site e reiniciar Apache
exec("sudo a2ensite $dominio.conf");
exec("sudo systemctl reload apache2");

echo "✅ Domínio '$dominio' criado e ativado com sucesso!\n";
?>
