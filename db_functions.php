<?php

function post_user() {
    return "
    INSERT INTO users (u_reg, u_email, u_name, u_password)
    VALUES (NOW(), ?, ?, ?);
    ";
}

function check_email() {
    return "
    SELECT users.id, users.u_name, users.u_password FROM users
    WHERE users.u_email = ?;
    ";
}

function get_tasks_for_user() {
    return "
    SELECT tasks.id, tasks.t_reg, tasks.t_name, tasks.t_desc, tasks.t_time, tasks.t_state, tasks.status_id, status.s_name, priority.p_name
    FROM tasks
    INNER JOIN users ON tasks.user_id = users.id
    INNER JOIN status ON tasks.status_id = status.id
    INNER JOIN priority ON tasks.priority_id = priority.id
    WHERE tasks.user_id = ? AND tasks.t_state = ?
    ORDER BY tasks.t_time, priority.p_name;
    ";
}

function post_task() {
    return "
    INSERT INTO tasks (t_reg, t_name, t_desc, t_time, t_state, user_id, status_id, priority_id)
    VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?);
    ";
}

function get_task_for_id() {
    return "
    SELECT tasks.t_reg, tasks.t_name, tasks.t_desc, tasks.t_time, tasks.t_state, status.s_name, priority.p_name
    FROM tasks
    INNER JOIN users ON tasks.user_id = users.id
    INNER JOIN status ON tasks.status_id = status.id
    INNER JOIN priority ON tasks.priority_id = priority.id
    WHERE tasks.user_id = ? AND tasks.id = ?
    ";
}

function close_task() {
    return "
    UPDATE tasks
    SET status_id = ?, t_state = ?
    WHERE id = ? AND user_id = ?;
    ";
}

function update_task() {
    return "
    UPDATE tasks
    SET t_name = ?, t_desc = ?, t_time = ?, t_state = ?, status_id = ?, priority_id = ?
    WHERE id = ? AND user_id = ?;
    ";
}

function get_status() {
    return "
    SELECT * FROM status;
    ";
}

function get_priority() {
    return "
    SELECT * FROM priority;
    ";
}

function get_data($connect, $sql) {
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        return [];
    }
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}
