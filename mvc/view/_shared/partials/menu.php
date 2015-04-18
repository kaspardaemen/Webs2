<ul>
    <?php

        foreach($GLOBALS["mainmenu"] as $parent)
        {
            if(Url::currentPath() == $parent["path"] || ($parent["controller"] == $page->getController()))
            {
                echo '<li class="active">';
                echo '<a href="'. Url::getRoot(). $parent["path"] .'">'.$parent["label"].'</a>';
                if(isset($parent["children"]))
                {
                    echo "<div><ul>";

                    foreach($parent["children"] as $child)
                    {
                        if(Url::currentPath() == $child["path"])
                        {
                            echo '<li class="active"><a href="'. Url::getRoot(). $child["path"] .'">'.$child["label"].'</a></li>';
                        }
                        else {
                            echo '<li><a href="'. Url::getRoot(). $child["path"] .'">'.$child["label"].'</a></li>';
                        }
                    }
                    echo "</ul></div>";
                }
                echo '</li>';
            }
            else{
                echo '<li>';
                echo '<a href="'. Url::getRoot(). $parent["path"] .'">'.$parent["label"].'</a>';
                echo '</li>';
            }
            echo '</li>';
        }
?>
</ul>


<!--<ul>
    <li class="active"><a href="<?php echo Url::build("Home", "Index"); ?>">Homesd</a></li>
    <li>
        <a href="#" class="containerItem"><a href="<?php echo Url::build("Home", "Sub"); ?>">Subpagina</a></a>
        <div>
            serie1
        </div>
    </li>
</ul>-->
