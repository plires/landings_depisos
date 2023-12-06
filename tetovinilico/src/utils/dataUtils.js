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
