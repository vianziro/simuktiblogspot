/*
 * Percobaan untuk Qt4 Cpp [Windows]
 * @author simukti <me@simukti.net>
 * @since 13-06-2010
 */

#include <QApplication>
#include <QHBoxLayout>
#include <QSlider>
#include <QSpinBox>

int main (int argc, char *argv[])
{
    QApplication app(argc, argv);

    QWidget *window = new QWidget;
    window->setWindowTitle("Masukkan Umur");

    QSpinBox *spinbox = new QSpinBox;
    QSlider *slider = new QSlider;

    spinbox->setRange(0, 130);
    slider->setRange(0, 130);

    QObject::connect(spinbox, SIGNAL(valueChanged(int)),
                    slider, SLOT(setValue(int)));

    QObject::connect(slider, SIGNAL(valueChanged(int)),
                    spinbox, SLOT(setValue(int)));

    spinbox->setValue(35);

    QHBoxLayout *layout = new QHBoxLayout;
    layout->addWidget(spinbox);
    layout->addWidget(slider);
    window->setLayout(layout);

    window->show();

    return app.exec();
}
