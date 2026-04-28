CREATE TABLE
    IF NOT EXISTS users (
        id integer not null primary key autoincrement,
        name text,
        password_hash text
    );

INSERT INTO users (id, name, password_hash) VALUES (1, "bean2", "$2y$10$OPOow5nX8acOM..8TgASnes30pjsP0NPjoCNBRReXHFu8nz2gxhhi");
INSERT INTO users (id, name, password_hash) VALUES (2, "elfo2", "$2y$10$UMImr1tF2f4F6jt05XiNO.KoeIEUAoujZH30F9hWgNbQ368Lu0Dte");