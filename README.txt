nginx;
PHP 7.0;
mysql 5.7

example config file:


server {
    listen 80;
    server_name example.local;
    root /some/location/example.local;
    index index.php index.html;
    location / {
        try_files $uri $uri/ /index.php;
    }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
     }
    location ~ /\.ht {
        deny all;
    }
}


In the file "school_library/sql/connectApplications.php" fill in the data for the database 

Run the file "school_library/sql/migration.php" 

Fill in constants in the file "school_library/core/ConstantInterface.php"

Fill in constants in the file "school_library/core/DbClass.php"

Set the value "host" in the file "school_library/js/admin.js"

all ready
 


