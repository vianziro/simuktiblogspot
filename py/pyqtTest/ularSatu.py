import sys
# import pyqt
from PyQt4 import QtCore, QtGui
from ularSatu_Gui import Ui_mainWindow

class myForm(QtGui.QMainWindow):
    def __init__(self, parent = None):
        QtGui.QWidget.__init__(self, parent)
        # instankan object Ui_mainWindow()
        self.ui = Ui_mainWindow()
        self.ui.setupUi(self)

if __name__ == "__main__":
    app = QtGui.QApplication(sys.argv)
    myApp = myForm()
    #tampilkan form
    myApp.show()
    sys.exit(app.exec_())