-- 1. Afficher les 3 utilisateurs qui ont publié le plus de contenus
SELECT utilisateurs.pseudo  FROM contenus INNER JOIN utilisateurs ON contenus.id_utilisateur = utilisateurs.id GROUP BY contenus.id_utilisateur
ORDER BY COUNT(contenus.id_utilisateur) DESC LIMIT 3

-- 2. Lister les contenus, avec :
SELECT contenus.id, contenus.chemin_image, utilisateurs.pseudo, COUNT(DISTINCT commentaires.id), COUNT(DISTINCT likes.id_utilisateur) FROM contenus
JOIN utilisateurs ON contenus.id_utilisateur = utilisateurs.id
LEFT JOIN likes ON contenus.id = likes.id_contenu
LEFT JOIN commentaires ON contenus.id = commentaires.id_contenu
GROUP BY contenus.id

-- 3. Lister les 3 contenus les plus likés avec leur nombre de likes
SELECT contenus.id, COUNT(likes.id_contenu) AS nombre_like FROM contenus 
INNER JOIN likes ON contenus.id = likes.id_contenu GROUP BY contenus.id
ORDER BY COUNT(likes.id_contenu) DESC LIMIT 3

-- 4. Lister les 3 contenus les plus commentés avec leur nombre de commentaires
SELECT contenus.id, COUNT(commentaires.id_contenu) AS nombre_commentaires FROM contenus 
INNER JOIN commentaires ON contenus.id = commentaires.id_contenu GROUP BY contenus.id
ORDER BY COUNT(commentaires.id_contenu) DESC LIMIT 3

-- 5. Afficher le nombre total de commentaires par jour
SELECT count(id) AS commentaires, DATE_FORMAT(date_publication," %e %m %Y") AS date_publi FROM commentaires 
GROUP BY date_publi


-- 6. Afficher les contenus sans commentaires
SELECT contenus.id FROM contenus LEFT JOIN commentaires ON contenus.id = commentaires.id_contenu
GROUP BY contenus.id
HAVING COUNT(commentaires.id_contenu) = 0

-- 7. Afficher les pseudos des utilisateurs n’ayant ni commenté ni liké aucun contenu
SELECT utilisateurs.pseudo FROM utilisateurs 
LEFT JOIN likes ON utilisateurs.id  = likes.id_utilisateur
LEFT JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur
GROUP BY utilisateurs.id
HAVING COUNT(likes.id_utilisateur) = 0 AND COUNT(commentaires.id_utilisateur) = 0

--8
SELECT DATE_FORMAT(contenus.date_publication, " %e %m %Y"),COUNT(contenus.id), COUNT(commentaires.id)  FROM contenus 
LEFT JOIN commentaires ON contenus.id = commentaires.id_contenu
GROUP BY  DATE_FORMAT(contenus.date_publication, " %e %m %Y")
ORDER BY  COUNT(contenus.id), COUNT(commentaires.id) 



--9. Afficher les informations des contenus ayant été likés au moins 10 fois et possédant au moins 5 commentaires
SELECT contenus.id, COUNT(DISTINCT likes.id_utilisateur), COUNT(DISTINCT commentaires.id) FROM contenus 
LEFT JOIN commentaires ON contenus.id = commentaires.id_contenu
LEFT JOIN likes ON contenus.id = likes.id_contenu
GROUP BY contenus.id
HAVING COUNT(DISTINCT likes.id_utilisateur) >= 10 AND COUNT(DISTINCT commentaires.id) >=5


--10. Afficher les utilisateurs ayant postés au moins 3 contenus durant les 5 minutes suivant leur date d’inscription

SELECT utilisateurs.id, utilisateurs.pseudo
FROM utilisateurs
JOIN contenus ON utilisateurs.id = contenus.id_utilisateur
WHERE TIMESTAMPDIFF(MINUTE, utilisateurs.date_inscription, contenus.date_publication) < 5
GROUP BY utilisateurs.id, utilisateurs.pseudo
HAVING COUNT(contenus.id) >= 3