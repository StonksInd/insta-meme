SELECT utilisateurs.pseudo  FROM contenus INNER JOIN utilisateurs ON contenus.id_utilisateur = utilisateurs.id GROUP BY contenus.id_utilisateur
ORDER BY COUNT(contenus.id_utilisateur) DESC LIMIT 3


SELECT contenus.id, contenus.chemin_image, utilisateurs.pseudo, COUNT(DISTINCT commentaires.id), COUNT(DISTINCT likes.id_utilisateur) FROM contenus
JOIN utilisateurs ON contenus.id_utilisateur = utilisateurs.id
LEFT JOIN likes ON contenus.id = likes.id_contenu
LEFT JOIN commentaires ON contenus.id = commentaires.id_contenu
GROUP BY contenus.id