<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{
    /**
     * Test Landing Page.
     *
     * @return void
     */
    public function testPaginaInicial()
    {
        dump('testPaginaInicial');
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Starter APP');
        });
    }

    /**
     * Test Admin Page.
     *
     * @return void
     */
    public function testDashboardSemLogin()
    {
        dump('testDashboardSemLogin');
        $this->browse(function (Browser $browser) {
            $browser->visit('admin/dashboard')
                ->assertPathIs('/auth/login');
        });
    }

    /**
     * Test Login Page.
     *
     * @return void
     */
    public function testPagina404()
    {
        dump('testPagina404');
        $this->browse(function (Browser $browser) {
            $browser->visit('/abobrinha')
                ->assertSee('Erro: 404 (Página não encontrada)');
        });
    }

    /**
     * Test Login Page.
     *
     * @return void
     */
    public function testLoginPage()
    {
        dump('testLoginPage');
        $this->browse(function (Browser $browser) {
            $browser->visit('auth/login')
                ->assertSee('Por favor, entre com suas credenciais.');
        });
    }

    /**
     * Test Password Email Page.
     *
     * @return void
     */
    public function testPasswordEmailPage()
    {
        dump('testPasswordEmailPage');
        $this->browse(function (Browser $browser) {
            $browser->visit('password/email')
                ->assertSee('Recuperar sua Senha?');
        });
    }

    /**
     * Test send password reset.
     *
     * @return void
     */
    public function testSendPasswordReset()
    {
        dump('testSendPasswordReset');
        $this->browse(function (Browser $browser) {
            $user = factory(\App\User::class)->create();
            $browser->visit('password/email')
                ->type('email', $user->email)
                ->press('ENVIAR')
                ->assertSee('Nós enviamos um link de recuperação de senha por e-mail.');
        });
    }

    /**
     * Test send password reset user not exists.
     *
     * @return void
     */
    public function testSendPasswordResetUserNotExists()
    {
        dump('testSendPasswordResetUserNotExists');
        $this->browse(function (Browser $browser) {
            $browser->visit('password/email')
                ->type('email', 'notexistingemail@gmail.com')
                ->press('ENVIAR')
                ->assertSee('Não conseguimos encontrar nenhum usuário com o endereço de e-mail especificado.');
        });
    }

    /**
     * Test send password reset user not exists.
     *
     * @return void
     */
    public function testSendPasswordRequiredFields()
    {
        dump('testSendPasswordRequiredFields');
        $this->browse(function (Browser $browser) {
            $browser->visit('password/email')
                ->type('email', 'abacate')
                ->press('ENVIAR')
                ->pause(2000)
                ->assertSee('O campo email não contém um endereço de email válido.');
        });
    }

    /**
     * Test new user registration required fields.
     *
     * @return void
     */
    public function testLoginPageRequiredFields()
    {
        dump('testLoginPageRequiredFields');
        $this->browse(function (Browser $browser) {
            $browser->visit('auth/login')
                ->type('email', '')
                ->type('password', '')
                ->press('Login')
                ->pause(1000)
                ->assertSee('O campo senha é obrigatório.')
                ->assertSee('O campo email é obrigatório.');
        });
    }

    /**
     * Test Login credentials not match.
     *
     * @return void
     */
    public function testLoginCredentialsNotMatch()
    {
        dump('testLoginCredentialsNotMatch');
        $this->browse(function (Browser $browser) {
            $browser->visit('auth/login')
                ->type('email', 'emailquesegurquenoexisteix@sadsadsa.com')
                ->type('password', '12345678')
                ->press('Login')
                ->pause(1000)
                ->assertSee('Credenciais informadas não correspondem com nossos registros.');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testICanLoginSuccessfully()
    {
        dump('testICanLoginSuccessfully');
        $this->browse(function ($browser) {
            $user = factory(\App\User::class)->create(['password' => \Hash::make('passw0RD'), 'activation' => true, 'company_id' => '1']);
            $browser->visit('auth/login')
                ->type('email', $user->email)
                ->type('password', 'passw0RD')
                ->press('Login')
                ->assertPathIs('/admin/dashboard');
        });
    }

    /**
     * Logout.
     */
    public function testLogout()
    {
        dump('testLogout');
        $this->browse(function (Browser $browser) {
            $browser->visit('admin/dashboard')
                ->click('.nav-profile')
                ->clickLink('Sair')
                ->pause(2000)
                ->assertPathIs('/');
        });
    }

    /**
     * [testLoginNewUser description].
     *
     * @return [type] [description]
     */
    public function testLoginNewUserSemEmpresa()
    {
        dump('testLoginNewUserSemEmpresa');
        $this->browse(function (Browser $browser) {
            $user = factory(\App\User::class)->create(['password' => \Hash::make('passw0RD')]);
            $browser->visit('auth/login')
                ->type('email', $user->email)
                ->type('password', 'passw0RD')
                ->press('Login')
                ->assertSee('Sua conta não esta veiculado a nenhuma empresa. Entre em contato com o Suporte!');
        });
    }

    public function testLoginNewUserComEmpresaSemAtivacao()
    {
        dump('testLoginNewUserComEmpresaSemAtivacao');
        $this->browse(function (Browser $browser) {
            $user = factory(\App\User::class)->create(['password' => \Hash::make('passw0RD'), 'company_id' => '1']);
            $browser->visit('auth/login')
                ->type('email', $user->email)
                ->type('password', 'passw0RD')
                ->press('Login')
                ->assertSee('Conta não ativada.');
        });
    }

    public function testLoginAtivando()
    {
        dump('testLoginAtivando');
        $this->browse(function (Browser $browser) {
            $token = str_random(60);
            $user = factory(\App\User::class)->create(['password' => \Hash::make('passw0RD'), 'activation_code' => $token]);
            $browser->visit('auth/activation/'.$token)
                ->assertSee('Sua conta foi ativada com sucesso.')
                ->type('email', $user->email)
                ->type('password', 'passw0RD')
                ->press('Login')
                ->assertSee('Sua conta não esta veiculado a nenhuma empresa. Entre em contato com o Suporte!');
        });
    }

    public function testLoginAtivandoComEmpresa()
    {
        dump('testLoginAtivandoComEmpresa');
        $this->browse(function (Browser $browser) {
            $token = str_random(60);
            $user = factory(\App\User::class)->create(['password' => \Hash::make('passw0RD'), 'activation_code' => $token, 'company_id' => '1']);
            $browser->visit('auth/activation/'.$token)
                ->assertSee('Sua conta foi ativada com sucesso.')
                ->type('email', $user->email)
                ->type('password', 'passw0RD')
                ->press('Login')
                ->assertSee($user->name);
        });
    }

    // quando logado testar as paginas de login, senha, social, 2fa

    // Login 2FA
    // Login Social Midia
}
