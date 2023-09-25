import slidesPrincipal from './../data/slidePrincipal.json'
import slidesSecundarioSuperior from './../data/slideSecundarioSuperior.json'
import slidesSecundarioInferior from './../data/slideSecundarioInferior.json'
import fajaServicios from './../data/fajaServicios.json'
import featuredProducts from './../data/featuredProducts.json'
import aplications from './../data/aplications.json'
import galery from './../data/galery.json'

export const getSlidesPrincipal = key => slidesPrincipal[key]
export const getSlidesSecundarioSuperior = key => slidesSecundarioSuperior[key]
export const getSlidesSecundarioInferior = key => slidesSecundarioInferior[key]
export const getFajaServicios = key => fajaServicios[key]
export const getFeaturedProducts = key => featuredProducts[key]
export const getAplications = key => aplications[key]
export const getGalery = key => galery[key]
