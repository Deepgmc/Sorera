<?
function count_logo_XY($a, $b, $c, $d){
    $NEW_Y = $c; $NEW_X = $d;
    $OLDX = $a;  $OLDY = $b; $NEWX=0; $NEWY=0;
    if (($OLDX > $NEW_X) & ($OLDY <= $NEW_Y))
    {$NEWX = $NEW_X; $percent = $NEW_X/$OLDX; $NEWY = $OLDY * $percent;}
    if (($OLDY > $NEW_Y) & ($OLDX <= $NEW_X))
    {$NEWY = $NEW_Y; $percent = $NEW_Y/$OLDY; $NEWX = $OLDX * $percent;}
    if (($OLDX <= $NEW_X) & ($OLDY <= $NEW_Y))
    {$NEWX = $OLDX; $NEWY = $OLDY;}
    if (($OLDX > $NEW_X) & ($OLDY > $NEW_Y))
    {	if ($OLDX >= $OLDY)
    {$NEWX = $NEW_X; $percent = $NEW_X/$OLDX;$NEWY = $OLDY * $percent;}
        if ($OLDY >= $OLDX)
        {$NEWY = $NEW_Y; $percent = $NEW_Y/$OLDY;$NEWX = $OLDX * $percent;}
    }
    $NEWY=round($NEWY); $NEWX=round($NEWX);
    if ($NEWY>$NEW_Y || $NEWX>$NEW_X)
    {
        $OLDX = $NEWX; $OLDY = $NEWY;
        if (($OLDX > $NEW_X) & ($OLDY <= $NEW_Y))
        {$NEWX = $NEW_X; $percent = $NEW_X/$OLDX; $NEWY = $OLDY * $percent;}
        if (($OLDY > $NEW_Y) & ($OLDX <= $NEW_X))
        {$NEWY = $NEW_Y; $percent = $NEW_Y/$OLDY; $NEWX = $OLDX * $percent;}
        if (($OLDX <= $NEW_X) & ($OLDY <= $NEW_Y))
        {$NEWX = $OLDX; $NEWY = $OLDY;}
        if (($OLDX > $NEW_X) & ($OLDY > $NEW_Y))
        {	if ($OLDX >= $OLDY)
        {$NEWX = $NEW_X; $percent = $NEW_X/$OLDX;$NEWY = $OLDY * $percent;}
            if ($OLDY >= $OLDX)
            {$NEWY = $NEW_Y; $percent = $NEW_Y/$OLDY;$NEWX = $OLDX * $percent;}
        }
    }
    return array($NEWX, $NEWY);
}