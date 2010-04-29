-- CATATAN DASAR SUBQUERY dan JOIN (MySQL 5.1)
-- database employees - http://launchpad.net/test-db/employees-db-1/1.0.6/+download/employees_db-full-1.0.6.tar.bz2
-- Total data 4,000,000 records yang tersebar di 6 tabel
-- Desain DB - http://dev.mysql.com/doc/employee/en/images/employees-schema.png
-- __simukti__ - http://simukti.blogspot.com/ || http://simukti.info/
-- Copyright (c) 2010 - Sarjono Mukti Aji - Indonesia

-- 3 tabel
-- tampilkan nama, nomer dept, nama departemen
-- untuk pegawai Finance
-- Jumlah = 17,346 records
SELECT d.dept_name AS "DEPARTEMEN", CONCAT(e.first_name, ' ', e.last_name) AS "NAMA"
FROM employees AS e,
     dept_emp AS de,
     departments AS d
WHERE e.emp_no = de.emp_no
AND de.dept_no = d.dept_no
AND de.dept_no = ( SELECT dept_no
                   FROM departments
                   WHERE dept_name LIKE '%Finance%'
                  )

-- untuk ngecek bener gaknya yang ditampilkan
-- bisa dilihat dari jumlah hasil records
-- Jumlah = 17,346 records
SELECT COUNT(de.emp_no)
FROM dept_emp AS de
WHERE de.dept_no = ( SELECT dept_no 
                     FROM departments
                     WHERE dept_name LIKE '%Finance%'
                   )


-- 4 tabel
-- tampilkan nama departemen, nama pegawai, gaji
-- untuk pegawai Finance (17,346)
SELECT d.dept_name AS "DEPARTEMEN", 
       CONCAT(e.first_name, ' ', e.last_name) AS "NAMA",
       s.salary AS "GAJI"
FROM employees AS e,
     dept_emp AS de,
     departments AS d,
     salaries AS s
WHERE e.emp_no = de.emp_no -- klo ini dibuang, komputerku jadi hang !!!
AND s.emp_no = de.emp_no
AND de.dept_no = d.dept_no
AND de.dept_no = ( SELECT dept_no
                   FROM departments
                   WHERE dept_name LIKE '%Finance%'
                  )
GROUP BY de.emp_no


-- Jumlah pegawai per departemen
SELECT de.dept_no AS "Kode Department", d.dept_name AS "Nama Department", COUNT(de.emp_no) AS "Jumlah Pegawai"
FROM dept_emp AS de, departments AS d
WHERE de.dept_no = d.dept_no
GROUP BY de.dept_no

-- Jumlah pegawai per title jabatan
SELECT title, COUNT(emp_no) AS "Jumlah"
FROM titles
GROUP BY title

-- tampilkan emp_no dan nama
-- untuk jabatan manager
SELECT  e.emp_no AS "ID Pegawai",
        CONCAT(e.first_name, ' ', e.last_name) AS "Nama Manager"
FROM dept_manager AS dm, employees AS e
WHERE e.emp_no = dm.emp_no


-- tampilkan nama Manager dan gajinya
SELECT  e.emp_no AS "ID Pegawai",
        CONCAT(e.first_name, ' ', e.last_name) AS "Nama Manager",
        s.salary AS "Gaji"
FROM dept_manager AS dm, employees AS e, salaries AS s
WHERE e.emp_no = dm.emp_no
AND s.emp_no = dm.emp_no
-- klo gak di GROUP, hasilnya 388
GROUP BY dm.emp_no



-- rata rata gaji per departemen
-- klo pake AVG() langsung trus di GROUP komputerku jadi Hang !!!
-- @TODO fix this mukti !!!

-- rata rata gaji Manager
-- klo pake AVG() langsung trus di GROUP komputerku jadi Hang !!!
-- @TODO fix this mukti !!!