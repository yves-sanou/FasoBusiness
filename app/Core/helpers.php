
<?php

/**
 * =========================================================
 * FASOBUSINESS BY COTEAMDEV
 * Fichier : app/Core/helpers.php
 * Fonctions globales de l'application
 * Compatible PHP 8.2+
 * =========================================================
 */

/* =========================================================
   1. ÉCHAPPEMENT HTML
========================================================= */

if (!function_exists('e')) {
    function e(mixed $value): string
    {
        return htmlspecialchars(
            (string) ($value ?? ''),
            ENT_QUOTES | ENT_SUBSTITUTE,
            'UTF-8'
        );
    }
}

/* =========================================================
   2. CONFIGURATION APPLICATION
========================================================= */

if (!function_exists('app_config')) {
    function app_config(): array
    {
        static $config = null;

        if ($config === null) {
            $file = dirname(__DIR__, 2) . '/config/config.php';

            if (!is_file($file)) {
                throw new RuntimeException(
                    'Fichier config/config.php introuvable.'
                );
            }

            $config = require $file;

            if (!is_array($config)) {
                throw new RuntimeException(
                    'Configuration FasoBusiness invalide.'
                );
            }
        }

        return $config;
    }
}

if (!function_exists('setting')) {
    function setting(string $key, mixed $default = ''): mixed
    {
        return app_config()['app'][$key] ?? $default;
    }
}

/* =========================================================
   3. URL ET REDIRECTIONS
========================================================= */

if (!function_exists('url')) {
    function url(string $path = '/'): string
    {
        $base = rtrim(
            (string) setting('base_path', ''),
            '/'
        );

        return $base . '/' . ltrim($path, '/');
    }
}

if (!function_exists('redirect')) {
    function redirect(string $path): never
    {
        header('Location: ' . url($path), true, 302);
        exit;
    }
}

/* =========================================================
   4. GESTION DES MESSAGES FLASH
========================================================= */

if (!function_exists('flash')) {
    function flash(string $key, ?string $value = null): ?string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            throw new RuntimeException(
                'La session doit être démarrée avant flash().'
            );
        }

        if ($value !== null) {
            $_SESSION['_flash'][$key] = $value;
            return null;
        }

        $message = $_SESSION['_flash'][$key] ?? null;

        unset($_SESSION['_flash'][$key]);

        return is_string($message) ? $message : null;
    }
}

/* =========================================================
   5. PROTECTION CSRF
========================================================= */

if (!function_exists('csrf')) {
    function csrf(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            throw new RuntimeException(
                'La session doit être démarrée avant csrf().'
            );
        }

        if (
            empty($_SESSION['_csrf']) ||
            !is_string($_SESSION['_csrf'])
        ) {
            $_SESSION['_csrf'] = bin2hex(
                random_bytes(32)
            );
        }

        return $_SESSION['_csrf'];
    }
}

if (!function_exists('verify_csrf')) {
    function verify_csrf(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            http_response_code(419);
            exit('Session expirée.');
        }

        $token = (string) ($_POST['_csrf'] ?? '');

        if (
            $token === '' ||
            !hash_equals(csrf(), $token)
        ) {
            http_response_code(419);
            exit('Session expirée. Rechargez la page.');
        }
    }
}

/* =========================================================
   6. FORMATAGE MONÉTAIRE
========================================================= */

if (!function_exists('money')) {
    function money(float|int|string $value): string
    {
        return number_format(
            (float) $value,
            0,
            ',',
            ' '
        ) . ' FCFA';
    }
}

/* =========================================================
   7. CONNEXION BASE DE DONNÉES
========================================================= */

if (!function_exists('db_one')) {
    function db_one(string $sql, array $params = []): ?array
    {
        $statement = Database::p()->prepare($sql);

        $statement->execute($params);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? $result : null;
    }
}

if (!function_exists('db_all')) {
    function db_all(string $sql, array $params = []): array
    {
        $statement = Database::p()->prepare($sql);

        $statement->execute($params);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

if (!function_exists('db_exec')) {
    function db_exec(string $sql, array $params = []): int
    {
        $pdo = Database::p();

        $statement = $pdo->prepare($sql);

        $statement->execute($params);

        return (int) $pdo->lastInsertId();
    }
}

/* =========================================================
   8. GESTION MULTI-ENTREPRISES
========================================================= */

if (!function_exists('company_id')) {
    function company_id(): int
    {
        if (!class_exists('Auth')) {
            return 0;
        }

        return (int) Auth::tenant();
    }
}

/* =========================================================
   9. JOURNALISATION / AUDIT
========================================================= */

if (!function_exists('audit')) {
    function audit(
        string $action,
        ?string $entity = null,
        ?int $id = null,
        array $details = []
    ): void {
        if (
            class_exists('Security') &&
            method_exists('Security', 'audit')
        ) {
            Security::audit(
                $action,
                $entity,
                $id,
                $details
            );
        }
    }
}

/* =========================================================
   10. UTILITAIRES SUPPLÉMENTAIRES
========================================================= */

if (!function_exists('is_post')) {
    function is_post(): bool
    {
        return strtoupper(
            $_SERVER['REQUEST_METHOD'] ?? 'GET'
        ) === 'POST';
    }
}

if (!function_exists('old')) {
    function old(string $key, mixed $default = ''): string
    {
        return e($_POST[$key] ?? $default);
    }
}

if (!function_exists('app_name')) {
    function app_name(): string
    {
        return (string) setting(
            'name',
            'FasoBusiness by Coteamdev'
        );
    }
}

