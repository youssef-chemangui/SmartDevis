<div class="suivi-container">
    <h2><?php echo $titre; ?></h2>
    <?php
    if (!empty($suivi) && is_array($suivi))
    {
        foreach ($suivi as $info)
        {
            echo "<div class='suivi-info'>";
            echo "<p><strong>Code :</strong> " . htmlspecialchars($info["msg_code"]) . "</p>";
            echo "<p><strong>Statut :</strong> " . htmlspecialchars($info["msg_statut"]) . "</p>";
            echo "<p><strong>Date :</strong> " . htmlspecialchars($info["msg_date"]) . "</p>";
            echo "</div>";
        }
    }
    else
    {
        echo "<h3>Aucune information trouvée pour ce code</h3>";
    }
    ?>
</div>
