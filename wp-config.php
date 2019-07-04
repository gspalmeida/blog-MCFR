<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'wpMCFR');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'wordpressAdminMCFR');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'dicaCandy08*');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']5Tx{HQ3dC~{njqVe6N&&6v}ZM%73q(Q=jD(Bnv8!Gz@dl((WNG~Z!./3gXGw6D$');
define('SECURE_AUTH_KEY',  'u3ckEq5+$? 1%^:Z6LOuzebem|z;R/6%)4#u=I.p>KqC8,r^kVMU(>DXGoW.DR5n');
define('LOGGED_IN_KEY',    '(<R)Exfp=N2A>tk*Z?O/Bzo[TTU]OpU)*M%yQM&R4mDsUExMI=i:qx4_`2BjN(7i');
define('NONCE_KEY',        '`;#YNMgtWL|sU1H0Vc;03-:0qx`p<=D}kDK 1k$&coqy-|wW_VgR8TkpmbPSOXby');
define('AUTH_SALT',        'D4#U^VE]QK&2s@-s!mrpQzjGi=dTEVb?EiWS3*2]KD+wm+J19;$v}m`n<x7@0$2$');
define('SECURE_AUTH_SALT', 'xMt8JM{4cp{fQpaiDL&/u/^w8gt&Ld.rmcM~|O%t3LZ _d>HqTEr+`Jept$?UZ*A');
define('LOGGED_IN_SALT',   'w*F(YDX<Cq-#zYLn98DnC9dM!TA>X[sQMId%b)bM1}8_.EnWl8:x@G*B.d?eMSHq');
define('NONCE_SALT',       'LvIeq_:c?1h%i92HL$DPeW1y1b&C@6;ZI=UHrN|#-4Z{l;O@>D0kku1L^+|`,8Dt');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/*Pular FTP pra DEV */
define('FS_METHOD', 'direct');

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');

