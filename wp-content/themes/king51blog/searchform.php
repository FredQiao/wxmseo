<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" value="<?php echo wp_specialchars($s, 1); ?>" size="16" name="s" id="s" />
<input type="submit" class="p" value="Search" />
</form>