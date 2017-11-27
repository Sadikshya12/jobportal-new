<?php $this->render('includes/header') ?>
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h1>Send Your Message</h1>
            <?php display_flash() ?>

            <form id="contact-form" method="post" action="/index/contact">
                <div class="field">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="field">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="field">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>

                <div class="field">
                    <button type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>
<?php $this->render('includes/footer') ?>