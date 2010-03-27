import sys
from PyQt4.QtCore import *
from PyQt4.QtGui import *
from PyQt4.QtSql import *

#http://www.rkblog.rk.edu.pl/w/p/qtsql-pyqt4-handling-databases/

app = QApplication(sys.argv)
w = QTextBrowser()

db = QSqlDatabase.addDatabase("QMYSQL");
db.setHostName("localhost")
db.setDatabaseName("sakila")
db.setUserName("sakila")
db.setPassword("sakila")

ok = db.open()

if ok:
    w.insertHtml('tersambung <br />')
else:
    w.insertHtml('gagal <br />')

# ini masih ada error, belum ak perbaiki
query = QSqlQuery(db)
if query.exec_("SHOW TABLES"):
    w.insertHtml('<br />')
    while query.next():
        table = query.value(1).toString()
        w.insertHtml('%s<br />' % table)
    
    w.insertHtml('<br />')
    w.insertHtml('Total % tables' % query.size())
        
w.show()
sys.exit(app.exec_())