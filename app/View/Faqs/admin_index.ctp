<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"><h3>FAQ</h3></div>
        <div class="col-md-3 top_space">

            <?php echo $this->Form->create('Faq') ?>
            <div class="input-group custom-search-form">
                <?php echo $this->Form->input('filter',array('placeholder'=>'Search...','class'=>'form-control','label'=>false) ) ?>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            <?php echo $this->Form->end() ?>

        </div>
        <div class="col-md-2 top_space">
            <?php
            echo '<div class="reset-button">'.$this->Html->link('Reset',array('controller' => 'faqs', 'action' => 'reset', 'admin' =>true),array('class'=>'btn btn-primary')).'</div>';
            ?>
        </div>
        <div class="col-md-2 top_space">
            <?php
            echo $this->Html->link(
                'Add new',
                '/admin/faqs/add',
                array('class' => 'btn btn-primary')
            );
            ?>
        </div>
    </div>
    <br/>
</div>


<?php $paginator = $this->Paginator;

//creating our table
echo '<table class="table table-hover">';

// our table header, we can sort the data user the paginator sort() method!
echo "<tr>";
echo "<th>" . $paginator->sort('id','ID') . " </th>";
echo "<th>" . $paginator->sort('type') . "</th>";
echo "<th>" . $paginator->sort('faq_category_id','FAQ Category') . "</th>";
echo "<th>" . $paginator->sort('question') . "</th>";
echo "<th>" . $paginator->sort('slug') . "</th>";
echo "<th>" . $paginator->sort('status') . "</th>";
echo '<th class="center">Action</th>';
echo "</tr>";


$i=1;
foreach( $faqs as $faq ):
    echo "<tr>";
    echo "<td>{$faq['Faq']['id']}</td>";
    echo "<td>{$faq['FaqCategory']['type']}</td>";
    echo "<td>{$faq['FaqCategory']['name']}</td>";
    echo "<td>{$faq['Faq']['question']}</td>";
    echo "<td>{$faq['Faq']['slug']}</td>";
    echo '<td class="center">'.$this->element('admin/toggle', array('status' => $faq['Faq']['status'])).'</td>';
    ?>

    <td class="actions">
        <?php
        echo $this->Html->link( 'Edit', array( 'action' => '/edit', $faq['Faq']['id'] ) ) .'&nbsp';
        echo $this->Form->postLink( 'Delete',array( 'action' => '/delete', $faq['Faq']['id'] ), array( 'confirm' => 'Are you sure you want to delete this Faq?' ) );
        ?>
    </td>

    <?php
    echo "</tr>";
    $i++;
endforeach;
unset($user);

echo "</table>";

?>

<?php echo $this->element('admin/paging') ?>