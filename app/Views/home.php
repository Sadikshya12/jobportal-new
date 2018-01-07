<?php $this->render('includes/header') ?>
    <div class="row">
        <div class="col-sm-12" style="text-align:justify">
            <!--  <h3>Job Lists</h3> -->
            <!-- <div class="row">
             <div class="col-sm-12" style="text-align:justify"> -->

            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Body of the page -->
            <div class="w3-container">
                <h2 style="color:grey; margin-top: 20px;">
                    <center><strong><u>Welcome to NEXUS</u></strong></center>
                </h2>
                <p style="color:grey;">
                <center>Find your suitable job here with NEXUS because no job is too small, you don't know where it can
                    LEAD.
                </center>
                </p>

                <table class="table table-hover" style="margin-top: 30px">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Job Role/Type</th>
                        <th>Location</th>
                        <th width="20%">Posted By</th>
                        <th width=10%></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($jobs): ?>
                        <?php foreach ($jobs as $index => $job): ?>
                            <tr>
                                <td><?= ++$index ?></td>
                                <td>
                                    <a href="/job/details/<?= $job->id ?>">
                                        <?= $job->title ?>
                                    </a>
                                </td>
                                <td><?= $job->location ?></td>
                                <td>
                                    <a href="/index/user/<?= $job->user_id ?>">
                                        <?= $job->first_name . ' ' . $job->second_name ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="/job/details/<?= $job->id ?>" class="btn btn-success">View Details</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>


                <!-- Pagination code -->
                <nav aria-label="Page navigation" style="margin-left: 920px">
                    <ul class="pagination pagination-sm justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
<?php $this->render('includes/footer') ?>