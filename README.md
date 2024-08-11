# Simple Social Media With Laravel

## Features :

### Real-time chat : 
Implementing Real-time Functionality Using **Laravel Reverb**.
Chat Template with **Dark Theme**.

![dark theme](https://github.com/danesh-dev/laravel-social-media/blob/main/github%20images/chat-dark.png)

![light theme](https://github.com/danesh-dev/laravel-social-media/blob/main/github%20images/chat-light.png)

### Posts :
Create, Remove, Like or UnLike Posts.
You can create posts with or without images !

![posts](https://github.com/danesh-dev/laravel-social-media/blob/main/github%20images/posts.png)

### Follow :
You can follow other users and start a chat with them.

![profile](https://github.com/danesh-dev/laravel-social-media/blob/main/github%20images/profile.png)


### Database :
We Have Used PostgreSQL in this app (you can modify `.env` or `docker-compose.yml` and change it to MySQL).
### How to run : 
##### Method 1 : 
 -  If you have Docker installed on your Pc you can run the project using docker:
  `sudo docker compose up`

##### Method 2 :
- First, you need to install dependancies: `compose install`
- copy `.env.example` to `.env` , and modify your database creadentials.
- `php artisan migrate`
- `php artisan serve`
- `php artisan reverb:start`
- `npm install && npm run dev`

You Can Access it on **http://127.0.0.1:8000/** 

### Requirments :
- composer
- PHP v8.3
- PostgreSQL (or MySQL)
- Docker (optional)
---

### Contact Me :
- GitHub : [link] https://github.com/danesh-dev
- Site : [link] https://danesh-dev.github.io/
- Mail : [link] danesh.dev07@gmail.com
