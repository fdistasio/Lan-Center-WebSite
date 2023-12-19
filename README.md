The project in question is about a LAN Center a place where many gather to use the available PCs and play various video games.

At the base it has a DataBase built according to the Entity / Relationship scheme.

As you can see, it is made up of 4 entities: Amministratore, Giocatore, Postazione and Videogioco (Administrator, Player, Workstation and Videogame). 
The administrator is unique in the system (he is associated, through a default Username, to all users) and he manages all the players. 
Players make reservations that include one or more seats. 
Finally, the workstations include different types of video games, not all workstations have the same video games.

The relational schema associated with the previous one will therefore be composed of:

Amministratore (username(pk), password)
Giocatore (id_giocatore(pk), nome_giocatore, cognome,data_di_nascita, email,numero_di_telefono, username, username_admin(fk))
Postazione (id_postazione(pk), servizio_bar, richieste_aggiuntive, data_prenotazione, orario, prezzo, id_giocatore(fk))
Videogioco (nome_videogioco(pk), anno_di_pubblicazione)
Comprende (nome_videogioco(pk), id_postazione(pk))

The Database uses 4 php pages: Home, Prenotazione, AreaRiservata and AreaAdmin (Home, Booking, Reserved Area and Admin Area).

Prenotazione:
The booking page manages the various bookings through a php form that forwards the information, via the post method, and records it in the tables: Player and Location.
It contains a management system for the requests made: in fact, if a reservation has already been made on the same date, at the same time and at the same location, 
it will not be possible to make another one.
This is made possible by checking whether the records just entered by the user contain the same information as others already present, using the query:

SELECT * FROM POSTAZIONE WHERE DATA_PRENOTAZIONE='$data_prenotazione' AND ORARIO='$orario' AND ID_POSTAZIONE='$postazione.
If the system finds a match, the request cannot be made.

AreaRiservata:
The Reserved Area page, on the other hand, manages the login of the system administrator. 
Through the session instructions, and by protecting access from SQL injection techniques, the admin accesses his reserved area (AreaAdmin).
SQL injection protection is handled via the following stripslashes functions: $username=stripslashes($username); $password=stripslashes($password);
Access is managed in a similar way to the booking system, in fact the following query is made: 

SELECT * FROM AMMINISTRATORE WHERE USERNAME_ADMIN='$username' AND PASSWORD='$passwmd5'.

The password is saved in md5 in the database. Consequently, before being compared it is converted by the php md5 () function. 
If there is a match between the data entered by the administrator and those in the database, it will be able to log in.

AreaAdmin:
The AreaAdmin page, on the other hand, allows the administrator to check all the necessary information on reservations.
This is displayed in a table via the query: 

SELECT NOME_GIOCATORE,COGNOME,DATA_DI_NASCITA,EMAIL,NUMERO_DI_TELEFONO,USERNAME,DATA_PRENOTAZIONE,ORARIO,PREZZO,SERVIZIO_BAR,RICHIESTE_AGGIUNTIVE 
FROM GIOCATORE INNER JOIN POSTAZIONE ON POSTAZIONE.ID_GIOCATORE=GIOCATORE.ID_GIOCATORE.

It also contains a user search system through their Username. In fact, through the query:

SELECT * FROM POSTAZIONE WHERE DATA_PRENOTAZIONE='$data_prenotazione' AND ORARIO='$orario' AND ID_POSTAZIONE='$postazione' 

the system searches for all the records corresponding to that particular username.

Home:
Finally, the Home Page, through php, shows the user all the games (in sequence thanks to the group concat function in SQL) associated with the various workstations. 
This is made possible by the query: 

SELECT COMPRENDE.ID_POSTAZIONE,group_concat(VIDEOGIOCO.NOME_VIDEOGIOCO order by VIDEOGIOCO.NOME_VIDEOGIOCO) AS LISTA_GIOCHI 
FROM VIDEOGIOCO INNER JOIN COMPRENDE ON VIDEOGIOCO.NOME_VIDEOGIOCO=COMPRENDE.NOME_VIDEOGIOCO GROUP BY COMPRENDE.ID_POSTAZIONE;
