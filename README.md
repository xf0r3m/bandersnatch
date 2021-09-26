Aplikacja Web organizująca pracę na zdalnych systemach za pomocą protokołu SSH ora SFTP. Projekt zrealizowany
w pełni w PHP oraz przy użyciu innych technologi webowych takich jak Bootstrap 4. Połączenia SSH oraz SFTP 
są obsługiwane przez bibliotekę phpseclib (dołączona do plików projektów)

Wymagania:

        - Linux/BSD
        - LAMP Stack
        - PHP >= 7.0

Instalacja:

        Przykładowo Ubuntu 18.04 (zakładając domyślną konfigurację LAMP Stack):
        1. sudo apt update && apt upgrade
        2. sudo apt install tasksel
        3. sudo tasksel (Wybieramy z listy serwer LAMP)
        4. git clone https://git.morketsmerke.net/xf0r3m/bandersnatch.git
        5. cd bandersnatch
        6. sudo mv * ..
        7. zmieniamy hasło bazy danych, na silne.
        8. sudo mysql < /var/www/html/install.sql
        9. Ustawiamy odpowiednie uprawnienia:
            9.1. sudo chown -R www-data:www-data /var/www/html
            9.2. sudo chmod -R 775 /var/www/html
                (grupa musi mieć prawa zapisu, aby można ściągać pliki z systemów zdalnych)
        10. Uruchamiamy przeglądarkę i spisujemy adres serwera z bandersnatch
        11. Dokonujemy pierwszej rejestracji jako admininistrator systemu.

Dokumentacja:

        Dokumentacja projektu znajduje się pod tym adresem: https://git.morketsmerke.net/xf0r3m/bandersnatch/wiki

ToDo:

        Jest jeszcze trochę rzeczy do zrobienia, spójrz na plik todo w plikach projektu.
