-- Create the `List` table to store lists of tasks.
CREATE TABLE List (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, -- Unique ID for each list, auto-incremented.
    title VARCHAR(255) NOT NULL, -- Title of the list, cannot be null.
    description VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(), -- Timestamp for when the list is created.
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() -- Timestamp for the last update of the list.
    ON UPDATE CURRENT_TIMESTAMP() -- Automatically update on row modification.
);

CREATE TABLE Tasks (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() 
    ON UPDATE CURRENT_TIMESTAMP(),
    is_checked TINYINT(1) UNSIGNED ZEROFILL NOT NULL DEFAULT 0, -- Status of the task: 0 (not done) or 1 (done).
    list_id INT(11) DEFAULT NULL, -- Foreign key referencing the `List` table.
    FOREIGN KEY (list_id) REFERENCES List(id)  -- Establish a relationship with the `List` table using `list_id`.
);