#!/bin/bash

# s'execute depuis /opt/lampp/htdocs/kyoto/MyTPE
# s'éxécute dans user/ après l'affectation des variables, à partir de la ligne 'cd user'

# parametres recus : $# nombre de parametres, $1 parametre courant
#__VAR__000__USERNAME
#__VAR__001__ADDRESS
#__VAR__002__TITLE
#__VAR__003__TITLE-EXTENDED
#__VAR__004__CLASS
#__VAR__005__SUBJECT
#__VAR__006__NUMBER_PEOPLE
#__VAR__00(6+x)__NAME-NUMBER x
#__VAR__020 : nombre d'axes
#__VAR__02X : nombre de parties dans l'axe X
#__VAR__031 : introduction existante ou non
#__VAR__032 : conclusion existante ou non
#__VAR__033 : fiches de synthèses existante ou non
#__VAR__1X0 : titre de l'axe X, introduction à l'axe X
#__VAR__1XY : titre de la partie Y de l'axe X

#NOTE : On considèrera l'introduction, la conclusion, et les fiches de synthèses comme faisant partie du nombre d'axes reçus
#       Puis l'on testera la valeur des booléens __VAR__03X qui informent de leur existence ou de leur non-existence
#       Ainsi les liens seront seulement adaptés pour correspondre à des formes particulières
#
#       Le titre de l'introduction sera de la forme __VAR__110, on considère qu'il n'a qu'une partie non-numérotée qui se suffit à elle-même
#       De même, ceux de la conclusion et des fiches de synthèse seront de la forme __VAR__1X0
#       Tous ces titres particuliers ne seront ajoutés après 'introduction', 'conclusion', 'synthèses' que si ils sont existants
#       Dans ce cas, ils seront aussi affectés grace aux booléens __VAR__03X


##              affectation des variables simples
username=$1; shift
address=$1; shift
title=$1; shift
title_extended=$1; shift
class=$1; shift
subject=$1; shift



##              raccourcis pour un fichier log et un fichier d'erreurs
log="$username.log"
error="$username.err.temp"



##              affectation des variables dont le nombre est indéfini
names[0]=$1; shift
for i in `seq 1 ${names[0]}`; do
        names[$i]=$1
        shift
done

structure[0]=$1; shift
for i in `seq 1 ${structure[0]}`; do
        structure[$i]=$1
        shift
done

##              affectation des booléens définissant l'existence des parties spéciales
intro_defined=$1; shift
conclu_defined=$1; shift
synth_defined=$1; shift

##              affectation des titres
let "number_titles = 0"
## le nombre de titres
for i in `seq 1 ${structure[0]}`; do
        for j in `seq 0 ${structure[$i]}`; do
                let "number_titles += 1"
                title[$number_titles]="$i#$j#$1";shift
                ## on écrit le titre sous la forme AXE#PARTIE#TITRE
                ## on remarque que $j commence à 0 car "2#0#blabla" correspond au titre de l'axe 2
                ## tandis que $i commence à 1, le premier axe étant l'introduction, il n'y a pas d'axe 0
        done
done


##              on va dans le dossier user/, pour que les commandes n'affectent aucun autre fichier du site
cd ../user
touch $log $error
chmod 666 $log $error
echo -e "[$username.log]\n" >> $log



##              copie du dossier template/ en un nouveau dossier portant l'adresse du site choisie par l'utilisateur comme nom
echo '[cp]' >> $log
###     un test -d vérifie si $adress est un répertoire existant : pour ne pas copier le répertoire dedans si il existe
if [ -d $address ]; then
        rm -R $address
        cp -R --preserve=mode ../generate/template $address >> $log 2>> $error
else
        cp -R --preserve=mode ../generate/template $address >> $log 2>> $error
fi



##              remplacement des variables d'utilisateur __VAR__00x
echo "[sed] variables d'utilisateur" >> $log
sed -i -re "s/__VAR__000__USERNAME/$username/g" $address/HEAD.tem $address/index.html.tem >> $log 2>> $error
sed -i -re "s/__VAR__001__ADDRESS/$address/g" $address/HEAD.tem $address/index.html.tem >> $log 2>> $error
sed -i -re "s/__VAR__002__TITLE/$title/g" $address/HEAD.tem $address/index.html.tem >> $log 2>> $error
sed -i -re "s/__VAR__003__TITLE-EXTENDED/$title_extended/g" $address/HEAD.tem $address/index.html.tem >> $log 2>> $error
sed -i -re "s/__VAR__004__CLASS/$class/g" $address/HEAD.tem $address/index.html.tem >> $log 2>> $error
sed -i -re "s/__VAR__005__SUBJECT/$subject/g" $address/HEAD.tem $address/index.html.tem >> $log 2>> $error



##              ajout des variable indéfinies, dont la place est marqué par des repères :
##              __VAR__006 : noms
##              __VAR__020 : lignes majeures (axes), contenant repère des lignes mineures et variables de titre d'axe __VAR__1x1
##              __VAR__02x : lignes mineures (parties), contenant variables de titre de partie __VAR__1xx
##              IMPORTANT : la forme de l'ajout diffère pour HEAD et pour index.html

###                             __VAR__006
echo "[sed] variables de nom" >> $log
for i in `seq 1 ${names[0]}`; do
        if [ $i != ${names[0]} ]; then
###             tant que le numéro du nom actuel n'est pas le dernier, on laisse le repère, et on met une virgule
                sed -i -re "/__VAR__006__NAMES/i ${names[$i]}, " $address/index.html.tem >> $log 2>> $error
        else
###             lorsque le numéro montre que le nom est le dernier, on remplace la variable
                sed -i -re "s/__VAR__006__NAMES/${names[$i]}/" $address/index.html.tem >> $log 2>> $error
        fi
done

###                             __VAR__020 pour HEAD
###     l'axe 1 est l'introduction, donc '0' n'apparait jamais
###     les deux derniers axes sont la conclusion et les fiches de synthèses
echo "[sed] variables indéfinies pour HEAD : Axes" >> $log
let "axe=1"

if [ $intro_defined -eq 1 ]; then
        let "axe_intro = 1"
else
        let "axe_intro = 0"
fi
if [ $conclu_defined -eq 1 ] && [ $synth_defined -eq 1 ]; then
        let "axe_conclu = ${structure[0]}-1"
        let "axe_synth = ${structure[0]}"
elif [ $conclu_defined -eq 1 ] && [ $synth_defined -eq 0 ]; then
        let "axe_conclu = ${structure[0]}"
        let "axe_synth = 0"
elif [ $conclu_defined -eq 0 ] && [ $synth_defined -eq 1 ]; then
        let "axe_conclu = 0"
        let "axe_synth = ${structure[0]}"
else
        let "axe_conclu = 0"
        let "axe_synth = 0"
fi


for i in '0' 'I' 'II' 'III' 'IV' 'V' 'VI' 'VII' 'VIII' 'IX' 'X' 'XI' 'XII' 'XII' 'XIV' 'XV'; do
        if [ $axe -eq $axe_intro ]; then                         ### pour le premier axe, la ligne majeure d'introduction
                sed -i -re "/__VAR__020/i \\\t\t\t\t<li><a href=\"work.php?axe=1&amp;part=0\" title=\"__VAR__110\"><br />Introduction</a></li>" $address/HEAD.tem >> $log 2>> $error

        elif [ $axe -eq $axe_conclu ]; then             ### pour l'avant-dernier axe, la ligne majeure de conclusion
                sed -i -re "/__VAR__020/i \\\t\t\t\t<li><a href=\"work.php?axe=$axe&amp;part=0\" title=\"__VAR__1`echo $axe`0\"><br />Conclusion</a></li>" $address/HEAD.tem >> $log 2>> $error

        elif [ $axe -eq $axe_synth ]; then              ### pour le dernier axe, la ligne majeure de synthèse
                sed -i -re "/__VAR__020/i \\\t\t\t\t<li><a href=\"work.php?axe=$axe&amp;part=0\" title=\"__VAR__1`echo $axe`0\"><br />Synthèses</a></li>" $address/HEAD.tem >> $log 2>> $error

        elif [ $axe -le ${structure[0]} ]; then         ### si $axe se situe toujours dans les axes existants (if $axe lower_equal(<=) $nombre_axes)
                sed -i -re "/__VAR__020/i \\\t\t\t\t<li><a href=\"work.php?axe=$axe&amp;part=0\" title=\"__VAR__1`echo $axe`0\"><br />-- $i --</a></li>\n\t\t\t\t\t<ol>\t\n\t\t\t\t\t\t__VAR__02$axe\n\t\t\t\t\t</ol>" $address/HEAD.tem >> $log 2>> $error

###             result :
###             <li><a href="work.php? axe=X &part=Y " title="__VAR__1X0"><br />-- $i_romain --</a></li>
###                     <ol>
###                             __VAR__02X
###                     </ol>
###             __VAR__020

        else                                            ### sinon, supprime le repère  __VAR__020
                sed -i -re "s/__VAR__020//" $address/HEAD.tem >> $log 2>> $error
        fi
###     augmente la valeur de $axe dans tous les cas pour ajouter l'axe suivant
        let "axe += 1"
done


###                             __VAR__02x pour HEAD
### a chaque boucle de $axe, on boucle sur $part pour passer par toutes les valeurs
echo "[sed] variables indéfinies pour HEAD : Parties" >> $log
for axe in `seq 1 ${structure[0]}`; do
        for part in `seq 1 ${structure[$axe]}`; do
                sed -i -re "/__VAR__02$axe/i <li><a href=\"work.php?axe=$axe&amp;part=$part\" title=\"__VAR__1$axe$part\"><br />(($part))</a></li>" $address/HEAD.tem
### result :    <li><a href=\"work.php?axe=$i&part=$j\" title=\"$title_mineur\">(($j))</a></li>
        done
        sed -i -re "s/__VAR__02$axe//" $address/HEAD.tem
done


###                             __VAR__020 pour index.html
###             structure semblable à la boucle __VAR__020 pour HEAD, en remplacant $axe par $i
###             MAIS si le test [ -d $x_title ] est vérifié, sed ajoute DIRECTEMENT le titre
echo "[sed] variables indéfinies pour index.html : Axes" >> $log

for i in `seq 1 $number_titles`; do
        axe=`echo ${title[$i]} | cut -d \# -f 1`
        if [ $axe -eq $axe_intro ];then
                intro_title=`echo ${title[$i]} | cut -d \# -f 3`
        elif [ $axe -eq $axe_conclu ];then
                conclu_title=`echo ${title[$i]} | cut -d \# -f 3`
        elif [ $axe -eq $axe_synth ];then
                synth_title=`echo ${title[$i]} | cut -d \# -f 3`
        fi
done

for i in `seq 1 ${structure[0]}`; do
###  teste d'abord si la chaine du titre exite ou non, si oui ajoute un deux-points et le titre
###  les "" empechent l'expansion du titre qui causerait une erreur "Too many arguments"
        if [ $i -eq $axe_intro ] && [ -n "$intro_title" ]; then
                sed -i -re "/__VAR__020/i \\\t\t\t\t<li><a href=\"work.php?axe=1&amp;part=0\">Introduction : $intro_title</a></li>" $address/index.html.tem >> $log 2>> $error
        elif [ $i -eq $axe_intro ]; then
                sed -i -re "/__VAR__020/i \\\t\t\t\t<li><a href=\"work.php?axe=1&amp;part=0\">Introduction</a></li>" $address/index.html.tem >> $log 2>> $error
        elif [ $i -eq $axe_conclu ] && [ -n "$conclu_title" ]; then
                sed -i -re "/__VAR__020/i \\\t\t\t\t<br /><li><a href=\"work.php?axe=$i&amp;part=0\">Conclusion : $conclu_title</a></li>" $address/index.html.tem >> $log 2>> $error
        elif [ $i -eq $axe_conclu ]; then
                sed -i -re "/__VAR__020/i \\\t\t\t\t<br /><li><a href=\"work.php?axe=$i&amp;part=0\">Conclusion</a></li>" $address/index.html.tem >> $log 2>> $error
        elif [ $i -eq $axe_synth ] && [ -n "$synth_title" ]; then
                sed -i -re "/__VAR__020/i \\\t\t\t\t<br /><li><a href=\"work.php?axe=$i&amp;part=0\">Fiches de synthèse : $synth_title</a></li>" $address/index.html.tem >> $log 2>> $error
        elif [ $i -eq $axe_synth ]; then
                sed -i -re "/__VAR__020/i \\\t\t\t\t<br /><li><a href=\"work.php?axe=$i&amp;part=0\">Fiches de synthèse</a></li>" $address/index.html.tem >> $log 2>> $error
        elif [ $i -le ${structure[0]} ]; then 
                sed -i -re "/__VAR__020/i \\\t\t\t\t<br /><li><a href=\"work.php?axe=$i&amp;part=0\">__VAR__1`echo $i`0</a></li>\n\t\t\t\t\t<ol>\t\n\t\t\t\t\t\t__VAR__02$i\n\t\t\t\t\t</ol>" $address/index.html.tem >> $log 2>> $error
        fi
done
### contrairement à la première, cette boucle n'est jamais dépassée, on supprime donc le repère après
sed -i -re "s/__VAR__020//" $address/index.html.tem >> $log 2>> $error


###                             __VAR__02x pour index.html
echo "[sed] variables indéfinies pour index.html : Parties" >> $log
for axe in `seq 1 ${structure[0]}`; do
        for part in `seq 1 ${structure[$axe]}`; do
                sed -i -re "/__VAR__02$axe/i <li><a href=\"work.php?axe=$axe&amp;part=$part\">__VAR__1$axe$part</a></li>" $address/index.html.tem >> $log 2>> $error
        done
        sed -i -re "s/__VAR__02$axe//" $address/index.html.tem >> $log 2>> $error
done



##              remplacement des variables de titre __VAR__1xx pour HEAD et index.html
## on utilise deux variables de nombres et une variable de titre pour siplifier la commande
echo "[sed] variables de titre pour HEAD et index.html" >> $log
for i in `seq 1 $number_titles`; do
        axe=`echo ${title[$i]} | cut -d \# -f 1`
        part=`echo ${title[$i]} | cut -d \# -f 2`
        text=`echo ${title[$i]} | cut -d \# -f 3`
        sed -i -re "s/__VAR__1$axe$part/$text/" $address/HEAD.tem $address/index.html.tem >> $log 2>> $error
done



##              renommage des fichiers utilisés
echo '[mv]' >> $log
mv $address/index.html.tem $address/index.html >> $log 2>> $error
mv $address/HEAD.tem $address/HEAD >> $log 2>> $error

##              création de tous les fichiers texte dont a besoin l'utilisateur
echo '[touch & chmod]' >> $log
for axe in `seq 1 ${structure[0]}`; do
        for part in `seq 0 ${structure[$axe]}`; do
                touch $address/VOS-FICHIERS-TEXTE/axe$axe-partie$part.txt >> $log 2>> $error
                chmod -v 777 $address/VOS-FICHIERS-TEXTE/axe$axe-partie$part.txt >> $log 2>> $error
        done
done

##              changement de tous les fichiers au format Windows
echo '[unix2dos]' >> $log
for  file in 'FOOT' 'HEAD' 'index.html' 'work.php' 'stylesheets.css'; do
        unix2dos $address/$file >> $log 2>&1
done
for file in `ls $address/VOS-FICHIERS-TEXTE`; do
        unix2dos -q $address/VOS-FICHIERS-TEXTE/$file >> $log 2>&1
done
for file in `ls $address/stylefiles`; do
        unix2dos -q $address/stylefiles/$file >> $log 2>&1
done

##              compression du dossier de l'utilisateur en une archive zip
##echo "[zip]" >> $log
##zip -vrTm $username-website.zip $address >> $log 2>>$error

##              inclusion du fichier temporaire d'erreur dans le fichier log
echo -e "\n\n\n[$username.error]\n" >> $log
cat $error >> $log
rm $error

##              affichage des variables reçues par le script
echo -e "\n\n[master.sh]\nAffichage des variables recues :" >> $log
echo "__VAR__000__USERNAME : $username" >> $log
echo "__VAR__001__ADDRESS : $address" >> $log
echo "__VAR__002__TITLE : $title" >> $log
echo "__VAR__003__TITLE-EXTENDED : $title_extended" >> $log
echo "__VAR__004__CLASS : $class" >> $log
echo "__VAR__005__SUBJECT : $subject" >> $log

echo "__VAR__006__NUMBER-NAMES : ${names[0]}" >> $log
for i in `seq 1 ${names[0]}`; do
        echo "__VAR__00`let "$i+6"`__NAME-$i : ${names[$i]}" >> $log
done

echo "__VAR__020__NUMBER-AXES : ${structure[0]}" >> $log
for i in `seq 1 ${structure[0]}`; do
        echo "__VAR__02$i : ${structure[$i]}" >> $log
done

echo "#__VAR__031__INTRO : $intro_defined" >> $log
echo "#__VAR__032__CONCLU : $conclu_defined" >> $log
echo "#__VAR__033__SYNTH : $synth_defined" >> $log

echo "__VAR__1XX__TITLES" >> $log
for i in `seq 1 $number_titles`; do
        axe=`echo ${title[$i]} | cut -d \# -f 1`
        part=`echo ${title[$i]} | cut -d \# -f 2`
        text=`echo ${title[$i]} | cut -d \# -f 3`
        echo "__VAR__1$axe$part : $text" >> $log
done

echo "`date "+%B %d at %H:%M"` : $address for $username" >> USERS.log
