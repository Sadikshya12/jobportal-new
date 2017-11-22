<table>
    <?php while ($user = $users->fetch_object()): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->first_name ?></td>
            <td><?= $user->second_name ?></td>
            <td><?= $user->username ?></td>
            <td><?= $user->password ?></td>
            <td><?= $user->email ?></td>
            <td><?= $user->address ?></td>
            <td><?= $user->country ?></td>
            <td><?= $user->user_type ?></td>
        </tr>
    <?php endwhile; ?>
</table>
