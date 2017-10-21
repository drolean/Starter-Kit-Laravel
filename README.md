# Starter Kit 

by Leandro Ross

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


    /*! Envio de SMS *
    Plivo::sendSMS([
        'src' => '1111111111',
        'dst' => '+554391062502',
        'text' => 'Testde de Mensagem legla'                   
    ]);
   
    /*! Lista de Aplicações */
    //Plivo::listApplications();

    /*! Detalhes da conta como credito */
    //Plivo::accountDetails();

    /*! Historico de Mensagems */
    //Plivo::allMessages();

    /*! Definição de preço */
    //Plivo::pricing(['country_iso' => 'BR']);