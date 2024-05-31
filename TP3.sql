1/Donnez le code et nom des clients originaires de 
« Casablanca » classés par ordre alphabétique croissant (nom).
SELECT code, nom
FROM clients
WHERE ville = 'Casablanca'
ORDER BY nom ASC;

2/Donnez le code et le libellé des produits de prix supérieur à 1500 DH.
SELECT code, libellé
FROM produits
WHERE prix > 1500;

3/Donnez la liste des factures du client de code 2.
SELECT *
FROM factures
WHERE client_code = 2;

4/Donnez la référence et la date des factures du client « SAMIR ».
SELECT reference, date
FROM factures
JOIN clients ON factures.client_code = clients.code
WHERE clients.nom = 'SAMIR';

