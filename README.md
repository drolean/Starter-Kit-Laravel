# Starter Kit 

by Leandro Ross

## Included

- Bootstrap V4 Theme
- Vue Components
- Notification Pusher
- Chat
- Tickets
- ACL Control
- Alert
- Log Activity
- Panel + Website or Only Panel
- SSL Support
- MultiSAS 
- Social Login
- 2FA Integration
- Laravel 5.5

## Starting

  * copy .env.example .env
  * php artisan key:generate
  * php artisan migrate --seed
  * apos instalado sera criado o usuário "***usuario@email.com***" senha "***secret***"
  * Painel **Gestão de Usuários** -> **Permissões(Rotas)** -> **Gerar Lista**


## Laravel Mix Install

- npm install --no-bin-links
- npm install cross-env

## Dusk Support Homestead

-- First of all, google-chrome is requried to be installed in guest OS:

```
$ wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add -

$ sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list'

$ sudo apt-get update && sudo apt-get install -y google-chrome-stable

$ sudo apt-get install -y xvfb
```

-- Try to start ./vendor/laravel/dusk/bin/chromedriver-linux --port=8888. If you have some errors about loading libraries (libnss3.so, libgconf-2.so.4), try this:

```$ sudo apt-get install -y libnss3-dev libxi6 libgconf-2-4```

-- Run

```$ Xvfb :0 -screen 0 1280x960x24 &```

Add Hosts /etc/hosts
