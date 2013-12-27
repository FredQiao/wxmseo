	</section><!-- end content --> 
<script type="text/javascript">$("#awlpercent").animate({"width":"75px"});</script>
<aside class="col_4 col">
<ul>
<?php
dynamic_sidebar();
?>
 
 <?php if ( is_home() ) : ?>   
    <li>
    	<h2>有意义</h2>
    	<ul><li style=" font-size:12px">
        	<?php get_links('-1',' ',' ',' ', FALSE, 'id', FALSE, FALSE,'-1', FALSE); ?></li>

        </ul>
    </li>
  <?php endif ?>
</ul>
</aside>
