__all__ = ['Verynice']

# Don't look below, you will not understand this Python code :) I don't.

from js2py.pyjs import *
# setting scope
var = Scope( JS_BUILTINS )
set_global_object(var)

# Code follows:
var.registers(['f'])
@Js
def PyJsHoisted_f_(this, arguments, var=var):
    var = Scope({'this':this, 'arguments':arguments}, var)
    var.registers([])
    return var.get('document').callprop('getElementById', Js('column'))
PyJsHoisted_f_.func_name = 'f'
var.put('f', PyJsHoisted_f_)
pass
pass


# Add lib to the module scope
Verynice = var.to_python()
