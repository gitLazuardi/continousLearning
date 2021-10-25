import Home from '../components/HomeComponent'
import Gis from '../components/xresources/GisComponent'
import CreateNote from '../components/crud/CrudComponent'
import Movies from '../components/xresources/OmdbComponent'
import Covid from '../components/xresources/CovidComponent'

export default {
    mode : 'history',
    linkActiveClass : 'active',
    routes : [
        {
            path : '/home',
            name : 'home',
            component : Home
        },
        {
            path : '/home/gis',
            name : 'Gis',
            component : Gis
        },
        {
            path : '/home/crud-spa',
            name : 'create',
            component : CreateNote
        },
        {
            path : '/home/movies',
            name : 'movies',
            component : Movies
        },
        {
            path : '/home/covid',
            name : 'covid',
            component : Covid
        },
    ]
}