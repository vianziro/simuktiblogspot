#!/usr/bin/env python

###############################################################
## author    : Sarjono Mukti Aji || __simukti
## mail      : sarjono.mukti.aji@gmail.com
## blog      : http://simukti.blogspot.com/
## comments  : this is for educational purpose. It's free to use, modified, distribute
##             ini cuma tampilan GUI saja, belum ada action(s) terhadap event(s)
## license   : GPL v3
###############################################################

import sys
# baris baris dibawah ini untuk compile langsung / on.the.fly.compiling
#from PyQt4 import QtCore, QtGui, uic
#
#kita mulai
#roket = QtGui.QApplication(sys.argv)
#info = uic.loadUi('ml_window_gui.ui')
#info.show()
#sys.exit(roket.exec_())
from PyQt4 import QtCore, QtGui
from ml_window_gui import Ui_MainWindow

class roket(QtGui.QMainWindow):
    def __init__(self, parent = None):
        QtGui.QWidget.__init__(self, parent)
        self.ui = Ui_MainWindow()
        self.ui.setupUi(self)

if __name__ == '__main__':
    app = QtGui.QApplication(sys.argv)
    start = roket()
    start.show()
    sys.exit(app.exec_())
