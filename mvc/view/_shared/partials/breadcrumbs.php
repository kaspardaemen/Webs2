<div id="breadcrumbs">
<?php

    $breadcrumbs = Breadcrumbs::getAll();
    for($i = 0; $i < count($breadcrumbs); $i++)
    {
        if($i != 0)
        {
            echo '<span class="arrow"></span>';
        }
        if($i == count(Breadcrumbs::getAll())-1)
        {
            echo '<a href="'.$breadcrumbs[$i]['url'].'" class="active">'.$breadcrumbs[$i]['label'].'</a>';
        }
        else
        {
            echo '<a href="'.$breadcrumbs[$i]['url'].'">'.$breadcrumbs[$i]['label'].'</a>';
        }
    }

?>
    <span class="clear"></span>
</div>