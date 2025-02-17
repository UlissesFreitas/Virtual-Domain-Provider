#!/bin/bash

# Define os comandos que serão executados no system()
COMANDOS="$(dirname "$0")/restart_services.sh"

C_FILE="reset_service.c"
BIN_FILE="reset_service_exeroot"

# Criação do código C
cat <<EOF > $C_FILE
#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>

int main() {
    setuid(0);
    system("$COMANDOS");
    return 0;
}
EOF

echo "[+] Código C gerado em '$C_FILE'"

# Compila o programa
gcc $C_FILE -o $BIN_FILE

if [ $? -ne 0 ]; then
    echo "[!] Erro ao compilar o programa."
    exit 1
fi

echo "[+] Programa compilado: '$BIN_FILE'"

# Define permissões para rodar comosuperusuario
chmod a+x $BIN_FILE
chmod a+s $BIN_FILE

echo "[+] Permissões de root aplicadas. Programa pronto para uso!"

#******************************************************
# Criaçao do script que sea executado pelo exeroot
SCRIPT="/var/projeto-asa/restart_services.sh"

cat <<EOF > $SCRIPT
#!/bin/bash
service named restart
(sleep 5; apachectl restart) &
EOF

echo "[+] Script Bash criado em '$SCRIPT'"

chmod +x $SCRIPT

echo "[+] Permissões de execução aplicadas '$SCRIPT'"
