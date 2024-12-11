Move to folder of the day and launch: 

```bash
docker run --rm -it \
    -v $(pwd):/var/www/html/ \
    php:8.4-fpm-alpine php index.php
```
