<?php

// ==================================================
// AUTENTICAÇÃO POR COOKIE ASSINADO
// Substitui $_SESSION, que não persiste na Vercel.
// ==================================================

const AUTH_COOKIE = 'hidro_auth';
const AUTH_TTL = 28800; // 8 horas

// Chave secreta usada para assinar o cookie.
function authSecret(): string
{
    $secret = getenv('AUTH_SECRET');
    return ($secret !== false && $secret !== '')
        ? $secret
        : 'chave-local-apenas-para-testes';
}

// Verifica se a conexão é HTTPS (inclui o proxy da Vercel).
function authHttps(): bool
{
    return ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https'
        || !empty($_SERVER['HTTPS']);
}

// Cria o cookie de login.
function authLogin(string $nome): void
{
    $payload = base64_encode(json_encode([
        'nome' => $nome,
        'exp'  => time() + AUTH_TTL,
    ]));

    $assinatura = hash_hmac('sha256', $payload, authSecret());

    setcookie(AUTH_COOKIE, $payload . '.' . $assinatura, [
        'expires'  => time() + AUTH_TTL,
        'path'     => '/',
        'secure'   => authHttps(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

// Retorna o nome do usuário logado ou null.
function authUsuario(): ?string
{
    $cookie = $_COOKIE[AUTH_COOKIE] ?? '';

    if (substr_count($cookie, '.') !== 1) {
        return null;
    }

    [$payload, $assinatura] = explode('.', $cookie);

    $esperada = hash_hmac('sha256', $payload, authSecret());
    if (!hash_equals($esperada, $assinatura)) {
        return null;
    }

    $dados = json_decode(base64_decode($payload), true);
    if (!is_array($dados) || ($dados['exp'] ?? 0) < time()) {
        return null;
    }

    return (string) ($dados['nome'] ?? 'Operador');
}

// Remove o cookie de login.
function authLogout(): void
{
    setcookie(AUTH_COOKIE, '', [
        'expires'  => time() - 3600,
        'path'     => '/',
        'secure'   => authHttps(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}