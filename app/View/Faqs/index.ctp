<?php if($faq_categories): ?>
<section id="faq" class="inner-page">
<div class="container"><!-- Question-container start-->

    <?php
    $owner_answers_html = $renter_answers_html = $owner_questions_html = $renter_questions_html = '';

        foreach($faq_categories as $faq_category) {

            if( $faq_category['Faq'] ) { // if category have faq

                if( $faq_category['FaqCategory']['type'] == "General" ) {
                    $owner_questions_html.= $this->Common->generateFaqQuestions($faq_category);
                    $owner_answers_html.=$this->Common->generateFaqAnswers($faq_category);

                }

                if( $faq_category['FaqCategory']['type'] == "Payment" ) {
                    $renter_questions_html.= $this->Common->generateFaqQuestions($faq_category);
                    $renter_answers_html.= $this->Common->generateFaqAnswers($faq_category);

                }

            }

        }


    ?>

    <div class="col-md-6">
        <h2><a href="#car-owner">General</a></h2>
        <?php echo $owner_questions_html ?>
    </div>

    <div class="col-md-6">
        <h2><a href="#car-renter">Payment</a></h2>
        <?php echo $renter_questions_html ?>
    </div>

</div>

<div class="container">
    <ul class="faq-container">
        <h2 id="car-owner">General</h2>
        <?php echo $owner_answers_html ?>

        <h2 id="car-renter">Payment</h2>
        <?php echo $renter_answers_html ?>
    </ul>
</div>
</section>
<?php endif ?>