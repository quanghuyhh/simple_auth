# Demo
https://user-images.githubusercontent.com/3841068/187868579-7a9a5286-90ef-4267-a4b2-999201b4fec0.mp4

# Run project
```
docker-composer up -d --build
```
- Frontend:
```
http://localhost:8081/admin
```

- API
```
http://localhost:8081/api
```

# Thirds party
- Custom base orm from https://github.com/noetix/Simple-ORM
- Custom router from https://github.com/bramus/router
- Use blade template from https://github.com/jenssegers/blade
- Config env from https://github.com/vlucas/phpdotenv
- Custom request param from symfony/http-foundation

# Docker service:
- Nginx
- Mysql
- Composer (Install dependencies)