SELECT 	koncerty.id as 'id koncertu', 
		koncerty.data_godzina as 'kiedy', 
        zespoly.nazwa as 'zespol', 
        lokale.nazwa as 'lokal',
        zespoly.gatunki as 'gatunek',
        lokale.adres as 'adres',
        koncerty.cena,
        koncerty.wiek
FROM koncerty, zespoly, lokale
WHERE koncerty.zespoly_id=zespoly.id AND koncerty.lokale_id=lokale.id
