<?php

require_once 'db.php';

$db = new Database();

if (isset($_POST['action']) && $_POST['action'] == 'view') {

    $output = '';
    $data = $db->read();
    
    if ($db->totalRowCount() > 0) {

        $output .= '<table class="table table-striped table-sm table-bordered">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Primeiro nome</th>
                    <th>Último nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
        ';

        foreach ($data as $row) {
            
            $output .= '<tr class="text-center text-secondary">
                <td>' . $row['id'] . '</td>
                <td>' . $row['primeiro_nome'] . '</td>
                <td>' . $row['ultimo_nome'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['phone'] . '</td>
                <td>
                    <a href="#" title="Ver detalhes" class="text-success"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                    <a href="#" title="Editar" class="text-primay"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;    
                    <a href="#" title="Deletar" class="text-danger"><i class="fas fa-trash-alt fa-lg"></i></a>
                </td></tr>
            ';
        }
        
        $output .= '</tbody></table>';
        echo $output;
        
    } else {
        echo '<h3 class="text-center text-secondary mt-5">:( Nenhum usuário encontrado na base de dados!</h3>';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'insert') {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $db->insert($fname, $lname, $email, $phone);
}