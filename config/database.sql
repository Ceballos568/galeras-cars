CREATE TABLE users(
    id           SERIAL PRIMARY KEY NOT NULL,
    firstname    VARCHAR(50)  NOT NULL,
    lastname     VARCHAR(50)  NOT NULL,
    email        VARCHAR(100) NOT NULL UNIQUE,
    psswd        TEXT         NOT NULL,
    mobile_phone VARCHAR(20)  NOT NULL UNIQUE,
    address      VARCHAR(100) NULL,
    birthday     DATE         NULL,
    status       BOOLEAN      DEFAULT TRUE,
    gender       CHAR(1)      DEFAULT NULL,
    created_at   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    deleted_at   TIMESTAMP    DEFAULT NULL
);