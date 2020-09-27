# Aplicatie Interviu

Toate fisierele vor fi urcate pe un server. Inainte de orice alta actiune, se va rula secventa de instalare.

Pentru instalare, se va rula scriptul "install.php". Aici, se vor introduce :
* numele serverului
* numele bazei de date unde se doreste instalarea aplicatiei
* username si parola pentru conectarea la baza de date aleasa

Pentru a facilita procesul de testare al aplicatiei, secventa de instalare creaza in prealabil date pentru test. Alte conturi sau task-uri pot fi adaugate oricand.

Dupa instalare, se va face redirectionare catre pagina de start (index.php).

Cont pentru administrarea aplicatiei:

* Username : admim

* Password : pass

* Rol : Admin

Conturi de conectare create in prealabil pentru utilizatori :

1. Username:John

Password: 1234

Rol :Team Member

2. Username :Bob

Password :9876

Rol :Team Member

3. Username:Mathew

Password:0000

Rol:Team Leader

Scurta descriere a aplicatiei : 

* Pentru gestionarea conturilor se foloseste contul de admin. Aici se pot adauga/sterge conturi, sau se pot modifica permisiunile conturilor existente.
*In pagina de 'Dashboard' vor aparea doar task-urile din ziua curenta, ordonate dupa importanta acestora.
*In pagina de 'All Tasks' vor aparea toate task-urile personale, ordonate dupa duedate.
*Fiecare user poate genera task-uri personale si poate sterge doar task-urile create de el.
*In plus fata de membrii echipei, leader-ul echipei poate crea task-uri pentru membrii si le poate vedea in pagina de All Tasks, separat de task-urile personale.
