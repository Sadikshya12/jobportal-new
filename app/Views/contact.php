<div class="row" col-md-offset-4>
    <div class="col-md-5 col-md-offset-4">
      <h1>Send Your Message</h1>

      <div id="form-messages"></div>
      
      <form id="contact-form" method="post" action="index.php?action=contact_controller">
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