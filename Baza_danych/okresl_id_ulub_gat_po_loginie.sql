SELECT u.login, du.ulubione_gatunki_id 
FROM `database`.uzytkownicy as u, `database`.dane_uzytkownika as du 
WHERE u.dane_uzytkownika_id=du.id 
AND u.login='Janeks'