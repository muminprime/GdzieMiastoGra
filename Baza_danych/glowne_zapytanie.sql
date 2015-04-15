SELECT 	koncerty.id as 'id koncertu', 
		koncerty.data_godzina as 'kiedy', 
        zespoly.nazwa as 'zespol', 
        lokale.nazwa as 'lokal',
        gatunki.nazwa as 'gatunek',
        lokale.adres as 'adres',
        koncerty.cena,
        koncerty.wiek
FROM koncerty, zespoly, lokale, gatunki
WHERE koncerty.zespoly_id=zespoly.id AND koncerty.lokale_id=lokale.id AND zespoly.gatunki_id=gatunki.id