# GeoIP2
Plugin GeoIP2 for [magixcms 3](https://www.magix-cms.com)

![product-icon-geoip2-db](https://user-images.githubusercontent.com/356674/121079969-1dffca00-c7db-11eb-91f4-d5e44fc5cec6.png)

### version 

[![release](https://img.shields.io/github/release/magix-cms/geoip2.svg)](https://github.com/magix-cms/geoip2/releases/latest)

Authors
-------

* Gerits Aurelien (aurelien[at]magix-cms[point]com)

## Description
Connexion à GeoIP2 pour vous permettre de développer vos propres outils

## Installation
 * Décompresser l'archive dans le dossier "plugins" de magix cms
 * Connectez-vous dans l'administration de votre site internet
 * Cliquer sur l'onglet plugins du menu pour sélectionner geoip2.
 * Une fois dans le plugin, laisser faire l'auto installation
 * Il ne reste que la configuration du plugin pour correspondre avec vos données.

Requirements
   ------------
   * CURL (http://php.net/manual/en/book.curl.php)
   
### Exemple d'utilisation dans vos plugins

```php
$geoip2 = new plugins_geoip2_public();
// --- Display country ISO
$geoip2->getIsoCountry();
````
Ressources
 -----
  * https://www.maxmind.com
  * https://github.com/maxmind/GeoIP2-php
  * https://www.magix-cms.com
