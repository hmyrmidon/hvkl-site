<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'hvkl_new_db');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'webadm');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'webadm');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ' S:pU(DtJlBr0fM#?mD@a_Hr>bxu,Js?/`3(W!3I]h=&3ktMj+4nh_|DrbT15LyC');
define('SECURE_AUTH_KEY',  '=(4B3Hm;lO.KiqCtYHIlBAbs!RfB`N2,w*b%^R)4fozNdQG?>cwlgWv v@4iYXew');
define('LOGGED_IN_KEY',    '-LIk^-p<Z^R~P+mP]jYK@}yf:e-P:[+mCB 5!Qv}@&$o%#e*=k;@eOU+g?SX[[al');
define('NONCE_KEY',        '?-!XU7#c,O_/US1~Wa=6X*Hd4d}jw@hK=Vx6$3VcG/:ecaro<>U;<Cts.F~[%;55');
define('AUTH_SALT',        'ygcM,D#J.JHMLq6ov>Jws_7!qL,`QA(:{^XjNv5(4?ApxsFEcBrXpHzI*XDf:54t');
define('SECURE_AUTH_SALT', '-X/Lf(PB zwZjm/tFjU7WMr!_Vb<ygcf<@*j$^&`~gl,m42}]1E#@WCU)hm.aM>6');
define('LOGGED_IN_SALT',   '3Hr9^OfPO-q1>,Lc 3?`C^.~kDey7jx)Q`,l1s6[Xq*Z#!uY_jIBiNds!B ;:dDi');
define('NONCE_SALT',       'o&[]Q<.U9|:@PWzABqF7I,i&ch:&Q|3(Z{S+X:K0*D1@c8K]<MRYAs)O#FDRr9*)');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'hvkl_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');