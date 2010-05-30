from django.http import HttpResponse
import pyinfo

def info(request):
    return HttpResponse(pyinfo.foo.fullText())