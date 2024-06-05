import slidesPrincipal from './../data/slidePrincipal.json'
import featuredProducts from './../data/featuredProducts.json'
import ventajas from './../data/ventajas.json'
import galery from './../data/galery.json'

export const getSlidesPrincipal = key => slidesPrincipal[key]
export const getFeaturedProducts = key => featuredProducts[key]
export const getVentajas = key => ventajas[key]
export const getGalery = key => galery[key]

export const getCurrentMonth = () => {
  const date = new Date()
  const month = date.toLocaleString('es-AR', { month: 'long' })
  return month
}

export const validation = values => {
  const errors = {}
  if (!values.name) {
    errors.name = 'Ingresá un nombre'
  }
  if (!values.email) {
    errors.email = 'Ingresá tu email'
  } else if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(values.email)) {
    errors.email = 'Ingresá un correo válido'
  }
  if (!values.phone) {
    errors.phone = 'Ingresá un teléfono'
  }
  if (!values.comments) {
    errors.comments = 'Enviá tu consulta'
  }
  if (!values.store) {
    errors.store = 'Por favor, seleccioná un showroom de preferencia'
  }
  return errors
}

export const getStores = async (setLoading, axios, setStores, toast) => {
  setLoading(true)

  try {
    const res = await axios.get(
      import.meta.env.VITE_ROOT + '/php/get-stores.php',
    )

    const myJson = JSON.stringify(res.data)
    const responseData = JSON.parse(myJson)

    if (responseData.success) {
      setStores(responseData.data)
    } else {
      responseData.errors.map(error => {
        return toast.error(error)
      })
    }
  } catch (error) {
    // Realizar acciones en caso de error
    toast.error(
      'Aparentemente en este momento no hay conexión con el servidor, por favor intente mas tarde.',
    )
  }

  setLoading(false)
}
