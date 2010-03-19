import sys
from PyQt4 import QtCore, QtGui
from ularSatu_Gui import Ui_Form

class myForm(QtGui.QMainWindow):
    def __init__(self, parent = None):
        QtGui.QWidget.__init__(self, parent)
        self.ui = Ui_Form()
        self.ui.setupUi(self)

        
if __name__ == "__main__":
    app = QtGui.QApplication(sys.argv)
    myApp = myForm()
    myApp.show()
    sys.exit(app.exec_())