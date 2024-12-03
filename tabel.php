<?php
session_start();
include 'db_connection.php';
try {
    if (!empty($_COOKIE['user'])) {
        $stmt2 = $conn->prepare('SELECT id FROM users WHERE username = ?');
        $stmt2->execute([$_COOKIE['user']]);
        $userid = $stmt2->fetchColumn();

        if ($userid) {
            $stmt = $conn->prepare("SELECT * FROM clients WHERE userid = ?");
            $stmt->execute([$userid]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }
    } else {
        $results = [];
    }
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        html,
        body,
        .intro {
            height: 100%;
        }

        .intro {
            margin-top: -180px;

        }

        table td,
        table th {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        thead th {
            color: #fff;
        }

        .card {
            border-radius: .5rem;
        }

        .table-scroll {
            border-radius: .5rem;
        }

        .table-scroll table thead th {
            font-size: 1.25rem;
        }

        thead {
            top: 0;
            position: sticky;
        }
    </style>
</head>

<body>
    <!--StartTabel-->
    <section class="intro">
        <div class="bg-image h-100" >
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card bg-dark shadow-2-strong">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-dark table-borderless mb-5">
                                            <thead>
                                                <tr>
                                                    <th scope="col">id</th>
                                                    <th scope="col">name</th>
                                                    <th scope="col">email</th>
                                                    <th scope="col">phone</th>
                                                    <th scope="col">address</th>
                                                    <th scope="col">created-at</th>
                                                    <th scope="col">edit / delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($results as $result): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($result['id']); ?></td>
                                                        <td><?= htmlspecialchars($result['name']); ?></td>
                                                        <td><?= htmlspecialchars($result['email']); ?></td>
                                                        <td><?= htmlspecialchars($result['phone']); ?></td>
                                                        <td><?= htmlspecialchars($result['address']); ?></td>
                                                        <td><?= htmlspecialchars($result['created_at']); ?></td>
                                                        <td>
                                                            <a href="edit.php?id=<?= htmlspecialchars($result['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                                                            <a href="delete.php?id=<?= htmlspecialchars($result['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?php if (empty($_COOKIE['user'])): ?>
                                            <p class="text-center text-white mt-3">You must create an account and log in to view results specific to each user.</p>
                                        <?php elseif (empty($results) && !empty($_COOKIE['user'])): ?>
                                            <p class="text-center text-white mt-3">No records found for this user.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--EndTabel-->


</body>

</html>