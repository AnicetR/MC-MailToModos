# MailToModos

Application CLI Dev en PHP 5.6.4

##Lancement de l'application
```sh
$ php mailToModos.php [-v]
```
L'option -v permet de lancer l'appli en verbose mode.

##Fonctionnement :
Le fonctionnement est simple, le script sera développé en PHP histoire d’éviter pas mal de soucis de perfs sur le serveur et de réduire au maximum la densité de code. Le script est exécuté toutes les 5 à 10 minutes. En fonction du nombre de joueurs et des pics définis dans la config, il calcule le ratio modo/joueurs et répond au besoin défini par l’admin.

Admettons que la config soit définie comme ci-dessous :
- Si il y a 100 joueurs ou plus, il faut 4 modos avec une marge de 1
- Si il y a 200 joueurs ou plus, il faut 6 modos avec une marge de 1
- Si il y a 260 joueurs ou plus, il faut 8 modos avec une marge de 2


A partir de là, le fonctionnement sera le suivant :
- Récupération du nombre de joueurs
- Si supérieur à 100, récupération de la liste des joueurs
-  script va ensuite chercher les modos connectés (en fonction de la BDD de pex rechargée en cache toutes les 12h) et les compter
- Une fois le compte fait, si le nombre de modos est inférieur au nombre défini dans la config en enlevant la marge, il envoie alors un mail à tous les modos qui ne sont pas connectés via mandrill. Pour éviter tout spam, si un modo a déjà reçu un mail dans les x heures précédente, l’envoi n’est pas effectué. (config)
- Lorsque ce cas de figure se présente, le script n’est plus exécuté tant que le palier de joueurs connecté n’évolue pas à la hausse sur une période de temps définie dans la config.

Pour ce qui est des youtubeurs, rien n'est encore définit.


## Todo's
 - Plein de trucs

## Dépendances:
- xPaw's PHPMinecraftQuery (https://github.com/xPaw/PHP-Minecraft-Query)
- PHP CLI Framework (https://etopian.com/software/php-cli-framework/)