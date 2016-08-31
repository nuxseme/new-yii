TOMTOP站群系统,由Yii2强力驱动
===============================

```
=========================================================================================
7888841588887  750888880057     91         42  288845240880   24888888042     74508080057 
 77778887777   887777777788     8887     7888  777778827777  9887777777884    480  77 788 
     782       88        88     82282   88788       88       587       781    282      88 
     285       88        88     82 788788  88       88       587       281    28888888885 
     284       88        88     84  7884   88       88       482       284    282         
     488       888888888888     88    7   788       887      7888888888887    484    
=========================================================================================
```

Nginx配置
-------------------

```
server {
    charset utf-8;
    client_max_body_size 128M;

    listen 80; ## listen for ipv4
    #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

    #服务器名
    server_name dev.dodocool.com;
    root        E:/work3/webroot/dodocool-com/web; #根据个人情况进行更改
    index       index.php;

    #日志文件
    access_log  E:/logs/dodocool.com-access.log;#根据个人情况进行更改
    error_log   E:/logs/dodocool.com-error.log;#根据个人情况进行更改

    #首页获取 URL 解析权
    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    #虚拟目录
    location ~ /dodocool/.*\.(js|css|jpg|png|jpeg|gif|bmp|ico|font|swf|flv|ttf|woff|woff2|svg|eot)(.*) {#根据个人情况进行更改
        root E:/work3/webroot/static;
    }

    # uncomment to avoid processing of calls to non-existing static files by Yii
    #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
    #    try_files $uri =404;
    #}
    #error_page 404 /404.html;

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        try_files $uri =404;
    }

    location ~ /\.(ht|svn|git) {
       deny all;
    }
}
```

Host配置
-------------------

```
127.0.0.1       dev.dodocool.com #根据实际情况进行更改
```

